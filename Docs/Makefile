###
#
#

SED=sed 's/^trait/interface/'
Constants=Constants.php
SOURCES+= ${Constants}
MockFromArrayCreatorTrait=MockFromArrayCreatorTrait.php
SOURCES+= ${MockFromArrayCreatorTrait}
YamlTestCasesReaderTrait=YamlTestCasesReaderTrait.php
SOURCES+= ${YamlTestCasesReaderTrait}

all:	html

clean:
	-@ rm ${SOURCES}
	-@ rm -rd html

html:	html/index.html

${Constants}:	../${Constants}
	-@ rm ${Constants}
	@ ln -s ../${Constants} ${Constants}

${MockFromArrayCreatorTrait}:	../${MockFromArrayCreatorTrait}
	@ ${SED} < ${>} > ${@}

${YamlTestCasesReaderTrait}:	../${YamlTestCasesReaderTrait}
	@ ${SED} < ${>} > ${@}

html/index.html:	${SOURCES} Doxyfile
	doxygen Doxyfile

