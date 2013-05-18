gaggify.me
========

Portal to share your gags instantly! Now, get up your own way to share favorite gags, star them and grab ideas to create new!

Get cloned
-------------

We love contribution! We write public codes. To get started, simply clone the code like:

	$ git clone https://github.com/Instinktech/gaggify.me.git
	$ cd gaggify.me && ls -l

You'll see that oil file there. This is the CLI script helps to create generators. It works like:

	$ sudo oil [...]

Once cloned, run the following command to let it refine:

	$ sudo oil refine install

This will make directories writable that are going to be used by application. Keep in mind about pointing your virtual host to the directory rather then browsing from relative url.

Lets point a virtual host now. Add host entry:

	$ sudo nano /etc/hosts
	
Here, enter your alias like

	127.0.0.1	gaggify.me
	
Press Ctrl + O, Y & Return. Now, create a vhost file.

	$ cd /etc/apache2/sites-available/
	$ cp default gaggify.me
	$ sudo nano gaggify.me
	
Paste the following snippet:

	<VirtualHost *:80>
        ServerAdmin webmaster@localhost
        ServerName      gaggify.me
        DocumentRoot /var/www/gaggify.me/public/
        <Directory /var/www/gaggify.me/public/>
                Options FollowSymLinks
                AllowOverride None
        </Directory>
	</VirtualHost>
	
Cool! We're done with configuration. Run the following command from same directory:

	$ sudo a2ensite gaggify.me
	$ sudo service apache2 restart

Whoa! It works!

## Contributors

The project is partially contributed by Instinktech developers at a time. This will take a pace later on.
* [Mail Us](mailto: info@instinktech.com)
* [Website](http://instinktech.com)
* [@Instinktech](https://twitter.com/Instinktech)

We'd love to get some tweets from you!.
