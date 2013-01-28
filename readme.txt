if you need secure connection
modify this line in the ".htaccess" file
to the hosting domain:

	RewriteRule ^(.*)$ https://domain.com/[roulette]/$1 [R,L]