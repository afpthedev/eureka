# Backend Dockerfile
FROM openjdk:17-alpine
WORKDIR /app
COPY backend/target/*.jar app.jar
ENTRYPOINT ["java", "-jar", "app.jar"]

# Python ML Servisi Dockerfile
FROM python:3.10-slim
WORKDIR /app
COPY mlservice/requirements.txt requirements.txt
RUN pip install --no-cache-dir -r requirements.txt
COPY mlservice/ /app
CMD ["gunicorn", "-b", "0.0.0.0:5000", "routes:app"] 