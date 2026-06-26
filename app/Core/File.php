<?php

namespace App\Core;

class File
{
    public function __construct(private readonly string $path)
    {
    }

    public function exists(): bool
    {
        return file_exists($this->path);
    }

    public function read(): array
    {
        if (!$this->exists()) {
            return [];
        }

        $data = json_decode(file_get_contents($this->path), true);

        return is_array($data) ? $data : [];
    }

    public function write(array $data): void
    {
        $directory = dirname($this->path);

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents(
            $this->path,
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
            LOCK_EX
        );
    }

    public function update(callable $callback): mixed
    {
        $handle = fopen($this->path, 'c+');

        if ($handle === false) {
            throw new \RuntimeException('Unable to open storage file.');
        }

        try {
            flock($handle, LOCK_EX);

            $contents = stream_get_contents($handle);
            $data = $contents ? json_decode($contents, true) : [];
            $data = is_array($data) ? $data : [];

            $result = $callback($data);

            ftruncate($handle, 0);
            rewind($handle);
            fwrite($handle, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

            return $result;
        } finally {
            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }
}
