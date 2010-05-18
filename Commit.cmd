@echo off
echo Name of this commit in this branch:
set /p cname=
git add *
git commit -m "%cname%"
git push origin master