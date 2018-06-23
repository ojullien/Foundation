@echo OFF
@cls
title Testing WEATHER ...
echo OFF
cls
echo Testing WEATHER, please wait ...
.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\Weather\config.xml
echo ON
@echo ON
@EXIT /B 0