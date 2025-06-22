curl -X POST https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost ^
  -H "Accept: application/json" ^
  -H "Content-Type: application/json" ^
  -H "key: tw3xTeXoc61c1c839a1d6ea5HkiN9uP0" ^
  -d "{\"origin\":\"3820\",\"destination\":\"3812\",\"courier\":\"jne\",\"items\":[{\"quantity\":1,\"weight\":1000,\"length\":10,\"width\":10,\"height\":10,\"price\":200}]}"




  curl -X POST https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "key: KEGiPZhdc61c1c839a1d6ea5G3OSlvbi" \
  -d '{
    "origin": "3820",
    "destination": "3812",
    "courier": "jne",
    "items": [
      {
        "quantity": 1,
        "weight": 1000,
        "length": 10,
        "width": 10,
        "height": 10,
        "price": 200
      }
    ]
  }'
