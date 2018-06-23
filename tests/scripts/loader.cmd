@echo OFF
@cls
title Testing LOADER ...
echo OFF
cls
echo Testing LOADER, please wait ...
.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\Loader\config.xml
echo ON
@echo ON
@EXIT /B 0