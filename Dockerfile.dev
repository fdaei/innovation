FROM registry.ops.mobit.ir/avinox-dev/backendbase:latest

WORKDIR /app
ADD . .
RUN composer dump-autoload
RUN chown -R www-data:www-data /app
USER www-data
EXPOSE 9000
CMD ["php-fpm"]
