<?php 
namespace ExemploCrud\Helpers;
use Throwable;

final class Utils {
    private function __construct() { }

    public static function dump(mixed $dados):void {
        echo "<pre";
        var_dump($dados);
        "</pre>";
    }

    public static function formatarPreco(float $valor): string {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
 
    public static function total(float $valor, int $qtd): string {
        $calcular = $valor * $qtd;
        return self::formatarPreco($calcular);
    }
}