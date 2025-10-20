# I’m Feeling Lucky — Laravel Project

This is a Laravel application running in Docker using `docker-compose`.

## 🚀 Quick Start

### ✅ Requirements

- Docker
- Docker Compose
- Make (usually available on Linux/macOS)

### 🔧 Installation & Run

In the project root, run:

```bash
make init
```

Visit http://localhost:8000 in your browser.

Note: you should wait until the `ollama` container will be ready. Just check logs:

```bash
docker-compose logs -f ollama
```
