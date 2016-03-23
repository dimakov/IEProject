Installation of Shiny Server on VM:

1. Add to /etc/apt/sources.list the following line:

	deb https://<my.favorite.cran.mirror>/bin/linux/ubuntu trusty/

2. sudo apt-get update
3. sudo apt-get install r-base
4. sudo su - \ -c "R -e \"install.packages('shiny', repos='https://cran.rstudio.com/')\""

5. sudo apt-get install gdebi-core
6. wget https://download3.rstudio.org/ubuntu-12.04/x86_64/shiny-server-1.4.2.786-amd64.deb
7. sudo gdebi shiny-server-1.4.2.786-amd64.deb

8. sudo apt-get install libmysqlclient-dev

9. Install needed packages for the app:

	sudo su - \ -c "R -e \"install.packages('RMySQL', repos='https://cran.rstudio.com/')\""
	sudo su - \ -c "R -e \"install.packages('DBI', repos='https://cran.rstudio.com/')\""
	sudo su - \ -c "R -e \"install.packages('DT', repos='https://cran.rstudio.com/')\""

12. Start shiny server:

	sudo /usr/bin/shiny-server --pidfile=/var/run/shiny-server.pid