@echo OFF
@cls
title Testing CRYPT ...
echo OFF
cls
echo Testing CRYPT, please wait ...
.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\Crypt\config.xml
echo ON
@echo ON
@EXIT /B 0