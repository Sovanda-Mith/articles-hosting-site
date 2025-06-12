#!/bin/bash

# Build and deploy script for host-side building

echo "🔨 Building application on host..."

# Install dependencies if node_modules doesn't exist or package.json changed
if [ ! -d "node_modules" ] || [ "package.json" -nt "node_modules" ]; then
    echo "📦 Installing dependencies..."
    npm install --legacy-peer-deps
    npm install pinia-plugin-persistedstate
fi

# Build the application
echo "⚡ Building for production..."
npm run build

# Check if build was successful
if [ $? -eq 0 ]; then
    echo "✅ Build successful!"
    
    # Build Docker image with pre-built files
    echo "🐳 Building Docker image..."
    docker build -f Dockerfile.node -t articles-hosting-site:latest .
    
    echo "🚀 Build and containerization complete!"
    echo "Run with: docker run -p 3000:3000 articles-hosting-site:latest"
else
    echo "❌ Build failed!"
    exit 1
fi
