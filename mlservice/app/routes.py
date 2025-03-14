from flask import Flask, request, jsonify

app = Flask(__name__)

@app.route('/predict', methods=['POST'])
def predict():
    sembol = request.json.get('sembol')
    # Dummy tahmin işlemi
    return jsonify({
        "sembol": sembol,
        "tahmin_tarihi": "2025-03-15",
        "tahmin_degeri": 12.34,
        "model": "Dummy"
    })

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000) 