#!/bin/bash

CURRENT_FOLDER=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

readarray -t VERSIONS < <(find . -maxdepth 1 -type d -printf '%P\n')

# Beginning of outer loop.
for VERSION in "${VERSIONS[@]}"
do
  VERSION_FOLDER="$CURRENT_FOLDER/$VERSION"
  readarray -t LANGUAGES < <(find "$VERSION_FOLDER" -maxdepth 1 -type d -printf '%P\n')

  for LANGUAGE in "${LANGUAGES[@]}"
  do
    SOURCE_PATH="$CURRENT_FOLDER/$VERSION/$LANGUAGE"
    TARGET_PATH="$CURRENT_FOLDER/_data"

    LANG_VERSION="$VERSION-$LANGUAGE"
    LANG_VERSION=${LANG_VERSION//./-}

    SOURCE_HOME="$SOURCE_PATH/meta-home.json"
    SOURCE_LEFT="$SOURCE_PATH/meta-left-menu.json"
    SOURCE_RIGHT="$SOURCE_PATH/meta-right-menu.json"

    TARGET_HOME="$LANG_VERSION-meta-home.json"
    TARGET_LEFT="$LANG_VERSION-meta-left-menu.json"
    TARGET_RIGHT="$LANG_VERSION-meta-right-menu.json"

    if [[ -e "$SOURCE_HOME" ]]
    then
      echo "Copying: $TARGET_HOME"
      cp -v "$SOURCE_HOME" "$TARGET_PATH/$TARGET_HOME"
      echo "Copying: $SOURCE_LEFT"
      cp -v "$SOURCE_LEFT" "$TARGET_PATH/$TARGET_LEFT"
      echo "Copying: $SOURCE_RIGHT"
      cp -v "$SOURCE_RIGHT" "$TARGET_PATH/$TARGET_RIGHT"
    fi
  done
done
# End of outer loop.

exit 0
