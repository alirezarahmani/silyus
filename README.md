Api address:
===
Get token:
```bash
curl http://localhost:42433/api/oauth/v2/token -d "client_id"=demo_client -d "client_secret"=secret_demo_client -d "grant_type"=password -d "username"=api@example.com -d "password"=sylius-api
```

