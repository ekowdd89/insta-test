.PHONY: backend frontend

backend:
	@cd backend && php artisan serve --host=0.0.0.0 --port=8000
frontend:
	@cd frontend && npm run dev