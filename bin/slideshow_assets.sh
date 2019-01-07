#!/bin/bash
cd ${0%/*}

curl http://digm.drexel.edu/crs/IDM100/presentations/assets/images.zip -o ~/Desktop/images.zip

cd ~/Desktop/
unzip images.zip
rm images.zip
open ~/Desktop/
cd -
