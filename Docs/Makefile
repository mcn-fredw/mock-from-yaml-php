###
#
#

SED=sed 's/^trait/interface/'
MockFromYamlVersion=MockFromYamlVersion.php
SOURCES+= ${MockFromYamlVersion}
MockFromArrayCreatorTrait=MockFromArrayCreatorTrait.php
SOURCES+= ${MockFromArrayCreatorTrait}
YamlTestCasesReaderTrait=YamlTestCasesReaderTrait.php
SOURCES+= ${YamlTestCasesReaderTrait}

all:	html

clean:
	-@ rm ${SOURCES}
	-@ rm -rd html

html:	html/index.html

${MockFromYamlVersion}:	../src/${MockFromYamlVersion}
	@ ${SED} < ${>} > ${@}

${MockFromArrayCreatorTrait}:	../src/${MockFromArrayCreatorTrait}
	@ ${SED} < ${>} > ${@}

${YamlTestCasesReaderTrait}:	../src/${YamlTestCasesReaderTrait}
	@ ${SED} < ${>} > ${@}

html/index.html:	${SOURCES} Doxyfile
	doxygen Doxyfile

