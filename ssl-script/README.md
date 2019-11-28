### Führe aus

```bash
# create a root authority cert
./create_root_cert_and_key.sh
```

```bash
# create a wildcard cert for mysite.com
./create_certificate_for_domain.sh MEINESEITE
```

oder 

````bash
# or create a cert for www.mysite.com, no wildcards
./create_certificate_for_domain.sh www.mysite.com www.mysite.com
````

Passe die v3.ext an

```text
[alt_names]
DNS.1 = MEINESEITE
```

Rufe die Seite auf & downloade dir das Zertifikat.
Füge es danach in den Keystore und truste es.

Oder führe folgendes in der Console aus:

```text
sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain MEINESEITE.crt
```

## Fürs Handy

Einfach die .pem Datei auf dein Handy kopieren. (Beachte, nicht in den Download Ordner sonst erkennt das Handy die Datei nicht)