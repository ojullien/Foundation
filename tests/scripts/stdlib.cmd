@echo OFF
@cls
title Testing STDLIB ...
echo OFF
cls
echo Testing STDLIB, please wait ...
.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\Stdlib\config.xml
echo ON
@echo ON
@EXIT /B 0