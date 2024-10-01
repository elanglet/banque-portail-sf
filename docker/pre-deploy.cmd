mkdir .\docker\app\
xcopy . .\docker\app\ /V /NFL /NDL /NJH /NJS /nc /ns /np /MIR /XF .gitignore /XD .git\ docker\ 
if %ERRORLEVEL% EQU 1 echo OKCOPY & goto end
:end
