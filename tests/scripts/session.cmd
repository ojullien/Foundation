@echo OFF
@cls
title Testing SESSION ...
echo OFF
cls
echo Testing SESSION, please wait ...
.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\Session\config.xml
echo ON
@echo ON
@EXIT /B 0