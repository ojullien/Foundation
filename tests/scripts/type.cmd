@echo OFF
@cls
title Testing TYPE ...
echo OFF
cls
echo Testing TYPE, please wait ...
.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\Type\config.xml
echo ON
@echo ON
@EXIT /B 0