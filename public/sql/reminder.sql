SELECT incomes.income_description, income_categories.name, incomes.nominal 
FROM incomes 
INNER JOIN income_categories 
ON incomes.income_category_id;

