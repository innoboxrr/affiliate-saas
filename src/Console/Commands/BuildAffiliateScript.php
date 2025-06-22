<?php

namespace Innoboxrr\AffiliateSaas\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class BuildAffiliateScript extends Command
{
    protected $signature = 'affiliate:build-script';

    protected $description = 'Minifica y ofusca el script aff-client.js para producción';

    public function handle()
    {
        // Ruta relativa al archivo actual (está en /Console)
        $inputPath = __DIR__ . '/../../../resources/js/aff-client.js';
        $outputPath = __DIR__ . '/../../../resources/js/aff-client.min.js';

        if (!file_exists($inputPath)) {
            $this->error("Archivo fuente no encontrado: $inputPath");
            return Command::FAILURE;
        }

        $process = new Process([
            'npx', 'javascript-obfuscator', $inputPath,
            '--output', $outputPath,
            '--compact', 'true',
            '--self-defending', 'true',
            '--control-flow-flattening', 'true',
            '--rename-globals', 'true',
        ]);


        $process->run();

        if ($process->isSuccessful()) {
            $this->info("✅ Script minificado correctamente:");
            $this->line($outputPath);
            return Command::SUCCESS;
        }

        $this->error("❌ Error al minificar el script:");
        $this->line($process->getErrorOutput());
        return Command::FAILURE;
    }
}
