<?php

$rules = [
    'blank_line_after_opening_tag' => true,
    'braces' => true,
    'concat_space' => ['spacing' => 'one'],
    'no_multiline_whitespace_around_double_arrow' => true,
    'no_empty_statement' => true,
    'elseif' => true,
    'encoding' => true,
    'single_blank_line_at_eof' => true,
    'no_spaces_after_function_name' => true,
    'function_declaration' => true,
    'include' => true,
    'indentation_type' => true,
    'no_alias_functions' => true,
    'blank_line_after_namespace' => true,
    'line_ending' => true,
    'no_trailing_comma_in_list_call' => true,
    'not_operator_with_successor_space' => true,
    'lowercase_constants' => true,
    'lowercase_keywords' => true,
    'method_argument_space' => true,
    'trailing_comma_in_multiline_array' => true,
    'no_multiline_whitespace_before_semicolons' => true,
    'single_import_per_statement' => true,
    'no_leading_namespace_whitespace' => true,
    'no_blank_lines_after_class_opening' => true,
    'no_blank_lines_after_phpdoc' => true,
    'object_operator_without_whitespace' => true,
    'no_spaces_inside_parenthesis' => true,
    'phpdoc_indent' => true,
    'phpdoc_inline_tag' => true,
    'phpdoc_no_access' => true,
    'phpdoc_no_package' => true,
    'phpdoc_scalar' => true,
    'phpdoc_summary' => true,
    'phpdoc_to_comment' => false, // for now it has been disabled (problems with /** @var ... */
    'phpdoc_trim' => true,
    'phpdoc_no_alias_tag' => ['type' => 'var'],
    'phpdoc_var_without_name' => true,
    'no_leading_import_slash' => true,
    'no_extra_consecutive_blank_lines' => ['extra', 'use'],
    'self_accessor' => true,
    'array_syntax' => ['syntax' => 'short'],
    'no_short_echo_tag' => true,
    'full_opening_tag' => true,
    'no_trailing_comma_in_singleline_array' => true,
    'single_blank_line_before_namespace' => true,
    'single_line_after_imports' => true,
    'single_quote' => true,
    'no_singleline_whitespace_before_semicolons' => true,
    'cast_spaces' => ['space' => 'single'],
    'standardize_not_equals' => true,
    'ternary_operator_spaces' => true,
    'no_trailing_whitespace' => true,
    'trim_array_spaces' => true,
    'binary_operator_spaces' => ['align_equals' => false, 'align_double_arrow' => false],
    'unary_operator_spaces' => true,
    'no_unused_imports' => true,
    'visibility_required' => true,
    'no_whitespace_in_blank_line' => true,
    'new_with_braces' => true,
    'mb_str_functions' => true,
    'class_definition' => true,
    'combine_consecutive_unsets' => true,
    'dir_constant' => true,
    'function_typehint_space' => true,
    'hash_to_slash_comment' => true,
    'is_null' => true,
    'lowercase_cast' => true,
    'method_separation' => true,
    'modernize_types_casting' => true,
    'no_php4_constructor' => true,
    'no_short_bool_cast' => true,
    'no_useless_else' => true,
    'non_printable_character' => true,
    'normalize_index_brace' => true,
    'ordered_class_elements' => true,
    'phpdoc_no_useless_inheritdoc' => true,
    'pow_to_exponentiation' => true,
    'psr4' => true,
    'short_scalar_cast' => true,
    'align_multiline_comment' => ['comment_type' => 'phpdocs_only'],
    'single_line_comment_style' => ['comment_types' => ['hash']],
    'no_null_property_initialization' => true,
    'non_printable_character' => false,
    'method_argument_space' => ['ensure_fully_multiline' => false, 'keep_multiple_spaces_after_comma' => false],
    'blank_line_before_statement' => ['statements' => ['return', 'try']],
    'no_superfluous_elseif' => true, 
];

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/tests',
        __DIR__ . '/config',
        __DIR__ . '/database',
    ]);

return PhpCsFixer\Config::create()
    ->setRules($rules)
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setUsingCache(true);
