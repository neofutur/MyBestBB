cd ..

cp -af  MyBestBB MyBestBB-$1
rm -rf  MyBestBB-$1/.svn
rm -rf  MyBestBB-$1/*/.svn
rm -rf  MyBestBB-$1/*/*/.svn
rm -rf  MyBestBB-$1/*/*/*/.svn
rm -rf  MyBestBB-$1/*/*/*/*/.svn
rm -rf  MyBestBB-$1/*/*/*/*/*/.svn
rm -rf  MyBestBB-$1/*/*/*/*/*/*/.svn
rm -rf  MyBestBB-$1/*/*/*/*/*/*/.svn
rm -rf  MyBestBB-$1/*/*/*/*/*/*/*/.svn
rm -rf  MyBestBB-$1/*/*/*/*/*/*/*/*/.svn
ls -alR MyBestBB-$1 | grep '.svn'

tar cv MyBestBB-$1/ >MyBestBB-$1.tar
gzip -c -9 MyBestBB-$1.tar >MyBestBB-$1.tar.gz
zip -9 -r  MyBestBB-$1.zip MyBestBB-$1
rm -f *.tar

chown -R apache:neonet .;chmod -R 770 .
cp -f MyBestBB-$1*gz /tmp
cp -f MyBestBB-$1*zip /tmp
cp -f MyBestBB-$1*gz /home2/virtuals/ww7.be/html/neofutur/tools/punbb/MyBestBB/
cp -f MyBestBB-$1*zip /home2/virtuals/ww7.be/html/neofutur/tools/punbb/MyBestBB/
cp -f MyBestBB-$1/Changelog_MyBestBB.txt /home2/virtuals/ww7.be/html/neofutur/tools/punbb/MyBestBB/
cp -f MyBestBB-$1/Changelog_MyBestBB.txt /home2/virtuals/ww7.be/html/neofutur/tools/punbb/MyBestBB/Changelog_MyBestBB_$1.txt
cp -f MyBestBB-$1/INSTALL_mybestBB* /home2/virtuals/ww7.be/html/neofutur/tools/punbb/MyBestBB/
cp -f MyBestBB-$1/UPGRADE_MyBestBB* /home2/virtuals/ww7.be/html/neofutur/tools/punbb/MyBestBB/
cp -f MyBestBB-$1/TODO* /home2/virtuals/ww7.be/html/neofutur/tools/punbb/MyBestBB/
cp -f MyBestBB-$1/README* /home2/virtuals/ww7.be/html/neofutur/tools/punbb/MyBestBB/

rm -rf MyBestBB-$1

cd /home2/virtuals/ww7.be/html/neofutur/tools/punbb/MyBestBB/
ls2html_ww7 -h .>index.php
chown -R apache:neonet .;chmod -R 770 .
cd -
#still in ..
mv *.zip ~/Release
mv *.tar.gz ~/Release

cd MyBestBB
#back in svn root


