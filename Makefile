###
#
#

test:
	vendor/bin/phpunit --configuration Tests/phpunit.xml

push:
	git push -u origin `git rev-parse --abbrev-ref HEAD`

