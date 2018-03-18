set +x

echo "Run the following from the app root:"
echo "   cd dna/vendor/neam/dna-project-base-stateless-file-management"
echo "   ../../../../composer.phar install --prefer-source --optimize-autoloader"

# not running composer from within docker any longer
#source ../../vendor/neam/dna-project-base-testing-setup/_ensure-deps.sh
