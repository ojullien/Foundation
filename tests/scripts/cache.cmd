@echo OFF
@cls
title Testing FILE ...
echo OFF
cls
echo Testing FILE, please wait ...
.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\Cache\config.xml
echo ON
@echo ON
@EXIT /B 0