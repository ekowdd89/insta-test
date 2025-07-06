<?php

$num1 = gmp_init("1234567890123456789012345678901234567890", 10);
$num2 = gmp_init("9876543210987654321098765432109876543210", 10);

$sum = gmp_add($num1, $num2);
$mul = gmp_mul($num1, $num2);

echo "Sum: " . gmp_strval($sum) . PHP_EOL;
echo "Mul: " . gmp_strval($mul) . PHP_EOL;


/**
 *
 * @param GMP $num
 * @return string
 * Export ke binary
 */
function gmp_to_binary(GMP $num): string
{
    return gmp_export($num);
}
/**
 *  Impor kembali jadi GMP
 *
 * @param string $binary
 * @return GMP
 */
function binary_to_gmp(string $binary): GMP
{
    return gmp_import($binary);
}


$gmp = gmp_init("12345678901234567890123456789012345678901234567890", 10);
$binary = gmp_to_binary($gmp);

echo "GMP: " . gmp_strval($gmp) . PHP_EOL;
echo "Binary: " . $binary . PHP_EOL;
