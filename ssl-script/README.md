## For generating a local ssl cert

### Run this commands

```bash
# create a root authority cert
./create_root_cert_and_key.sh
```

```bash
# create a wildcard cert for mysite.com
./create_certificate_for_domain.sh MEINESEITE
```

or this for none wildcards

````bash
# or create a cert for www.mysite.com, no wildcards
./create_certificate_for_domain.sh www.mysite.com www.mysite.com
````

Edit the v3.ext file and change it to your site name.

```text
[alt_names]
DNS.1 = MEINESEITE
```

Open local your site and download the certificate.
Put it to your local Keystore and trust it, because you generated it.

Or run this command in the console:

```text
sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain MEINESEITE.crt
```

## Want to watch the site from your cellphone?

Put the .pem File to your cellphone. (Attention! Do not put it into the normal Download folder, because you can't see / install it from there)
Then open and install it to your device.

Have fun.
