@echo OFF
@cls
title Testing PROTOCOL ...
echo OFF
cls
echo Testing PROTOCOL, please wait ...
@.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\Protocol\config.xml