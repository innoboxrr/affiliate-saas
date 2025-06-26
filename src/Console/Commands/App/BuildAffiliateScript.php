<?php

namespace Innoboxrr\AffiliateSaas\Console\Commands\App;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class BuildAffiliateScript extends Command
{
    protected $signature = 'affiliate:build-script {--level=5 : Nivel de ofuscación (1-5)}';

    protected $description = 'Minifica y ofusca el script aff-client.js para producción';

    public function handle()
    {
        $level = (int) $this->option('level');

        if ($level < 1 || $level > 5) {
            $this->error("Nivel inválido: $level. Debe ser entre 1 y 5.");
            return Command::FAILURE;
        }

        if (!shell_exec('which npx')) {
            $this->error("❌ Error: 'npx' no está instalado o no está en el PATH.");
            return Command::FAILURE;
        }

        $basePath = realpath(__DIR__ . '/../../../../resources/js');
        $inputPath = "{$basePath}/aff-client.js";
        $outputPath = "{$basePath}/aff-client.min.js";
        $tempPath = "{$basePath}/aff-client.tmp.js";

        if (!file_exists($inputPath)) {
            $this->error("❌ Archivo fuente no encontrado: $inputPath");
            return Command::FAILURE;
        }

        $content = file_get_contents($inputPath);
        $content = preg_replace("/ENV:\s*'test'/", "ENV: 'prod'", $content);
        $content = preg_replace("/DEBUG:\s*true/", "DEBUG: false", $content);

        file_put_contents($tempPath, $content);

        $process = $this->getObfuscationProcess($level, $tempPath, $outputPath);

        $this->info("🚀 Ejecutando ofuscación (nivel $level)...");
        $start = microtime(true);
        $process->run();
        $duration = round(microtime(true) - $start, 2);

        unlink($tempPath);

        if (!$process->isSuccessful()) {
            $this->error("❌ Error al minificar:");
            $this->line($process->getOutput());
            $this->line($process->getErrorOutput());
            return Command::FAILURE;
        }

        if (!file_exists($outputPath) || filesize($outputPath) < 100) {
            $this->error("❌ Archivo de salida inválido o vacío.");
            return Command::FAILURE;
        }

        $this->info("✅ Script minificado correctamente:");
        $this->line($outputPath);
        $this->line("⏱️ Tiempo total: {$duration}s");
        return Command::SUCCESS;
    }

    protected function getObfuscationProcess(int $level, string $tempPath, string $outputPath): Process
    {
        $common = [
            'npx', 'javascript-obfuscator', $tempPath,
            '--output', $outputPath,
            '--compact', 'true',
            '--self-defending', 'true',
            '--rename-globals', 'true',
        ];

        switch ($level) {
            case 1:
                return new Process([...$common]);

            case 2:
                return new Process([
                    ...$common,
                    '--string-array', 'true',
                    '--string-array-threshold', '0.5',
                ]);

            case 3:
                return new Process([
                    ...$common,
                    '--string-array', 'true',
                    '--string-array-threshold', '0.5',
                    '--dead-code-injection', 'true',
                    '--dead-code-injection-threshold', '0.2',
                ]);

            case 4:
                return new Process([
                    ...$common,
                    '--string-array', 'true',
                    '--string-array-threshold', '0.6',
                    '--dead-code-injection', 'true',
                    '--dead-code-injection-threshold', '0.3',
                    '--split-strings', 'true',
                    '--split-strings-chunk-length', '6',
                ]);

            case 5:
            default:
                return new Process([
                    ...$common,
                    '--control-flow-flattening', 'true',
                    '--control-flow-flattening-threshold', '0.4',
                    '--dead-code-injection', 'true',
                    '--dead-code-injection-threshold', '0.3',
                    '--string-array', 'true',
                    '--string-array-threshold', '0.6',
                    '--string-array-encoding', 'base64',
                    '--disable-console-output', 'true',
                    '--transform-object-keys', 'true',
                    '--split-strings', 'true',
                    '--split-strings-chunk-length', '6',
                ]);
        }
    }
}
