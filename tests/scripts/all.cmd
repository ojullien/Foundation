@echo OFF
@cls
title Testing ALL ...
echo OFF
cls
:INIT
echo -------------------------------------------------------------------------------
echo Initializing ...
set _ListFile=cache crypt exception file form gd loader log protocol session stdlib type weather
:TEST
echo -------------------------------------------------------------------------------
@for %%b in ( %_ListFile% ) do (
@title Testing %%b, please wait ...
@echo Testing %%b, please wait ...
@.\..\..\vendor\bin\phpunit --verbose --configuration  %~dp0\..\Foundation\%%b\config.xml
)
:EOF
title Test done
pause
echo ON
@echo ON
@EXIT /B 0