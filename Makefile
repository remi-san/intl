FEATURES ?=

# install all the dependencies
compile-resources:
	rm -f ./tests/i18n/compiled/*.txt && cd ./tests/i18n/src && genrb *.txt -d ../compiled
