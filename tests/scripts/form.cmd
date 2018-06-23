@echo OFF
@cls
title Testing FORM ...
echo OFF
cls
echo Testing FORM, please wait ...
.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\Form\config.xml
echo ON
@echo ON
@EXIT /B 0