#!/bin/bash
alias t="phpunit"
alias s="git status"
alias u="git push origin v0.x.x"
alias d="git pull origin v0.x.x"
alias a="git add . "

c() { git commit -m "$@"; }
r() { git rm $@;}
rr() { git rm -r $@;}