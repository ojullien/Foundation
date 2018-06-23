@echo OFF
@cls
title Testing GD ...
echo OFF
cls
echo Testing GD, please wait ...
.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\Gd\config.xml
echo ON
@echo ON
@EXIT /B 0