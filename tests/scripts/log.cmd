@echo OFF
@cls
title Testing LOG ...
echo OFF
cls
echo Testing LOG, please wait ...
.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\Log\config.xml
echo ON
@echo ON
@EXIT /B 0