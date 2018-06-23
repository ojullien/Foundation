@echo OFF
@cls
title Testing EXCEPTION ...
echo OFF
cls
echo Testing EXCEPTION, please wait ...
.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\Exception\config.xml
echo ON
@echo ON
@EXIT /B 0