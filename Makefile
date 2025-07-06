.PHONY: backend frontend jwtkey migrate clear seed tinker

backend:
	@cd backend && php artisan serve --host=0.0.0.0 --port=8000
jwtkey:
	@cd backend && php artisan jwt:secret
migrate:
	@cd backend && php artisan migrate
clear:
	@cd backend && php artisan config:clear && php artisan cache:clear && php artisan route:clear
seed:
	@cd backend && php artisan db:seed
tinker:
	@cd backend && php artisan tinker
frontend:
	@cd frontend && npm run dev