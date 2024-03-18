#!/bin/sh

# SOURCE_WP_DIR must be set via CLI or env file
if [ -z "$SOURCE_WP_DIR" ]; then
    echo "Error: The SOURCE_WP_DIR environment variable is not set."
    exit 1
fi

# SOURCE_SQL_DIR must be set via CLI or env file
if [ -z "$SOURCE_SQL_DIR" ]; then
    echo "Error: The SOURCE_SQL_DIR environment variable is not set."
    exit 1
fi

# Define the target directories
TARGET_WP="/target-wp"
TARGET_SQL="/target-sql"

# Check if the target directory Wordpress directory exists, exit if so, create if not
if [ ! -d "$TARGET_WP" ]; then
    echo "The target directory $TARGET_WP does not exist. Creating it..."
    mkdir "$TARGET_WP"
    if [ $? -ne 0 ]; then
        echo "Error: Failed to create the target directory $TARGET_WP."
        exit 1
    fi
    echo "The target directory $TARGET_WP has been created."
else
    echo "The target directory $TARGET_WP already exists."
    # exit 1
fi

# Check if the target directory MySQL directory exists, exit if so, create if not
if [ ! -d "$TARGET_SQL" ]; then
    echo "The target directory $TARGET_SQL does not exist. Creating it..."
    mkdir "$TARGET_SQL"
    if [ $? -ne 0 ]; then
        echo "Error: Failed to create the target directory $TARGET_SQL."
        exit 1
    fi
    echo "The target directory $TARGET_SQL has been created."
else
    echo "The target directory $TARGET_SQL already exists."
    # exit 1
fi

# Copy the contents from the source to the target Wordpress directory, exit if fail
cp -r $SOURCE_WP_DIR/* $TARGET_WP/
if [ $? -ne 0 ]; then
    echo "Error: Failed to copy files from $SOURCE_WP_DIR to $TARGET_WP."
    exit 1
fi
echo "Contents have been successfully copied from $SOURCE_WP_DIR to $TARGET_WP."

# Copy the contents from the source to the target MySQL directory, exit if fail
cp -r $SOURCE_SQL_DIR/* $TARGET_SQL/
if [ $? -ne 0 ]; then
    echo "Error: Failed to copy files from $SOURCE_SQL_DIR to $TARGET_SQL."
    exit 1
fi
echo "Contents have been successfully copied from $SOURCE_SQL_DIR to $TARGET_SQL."
