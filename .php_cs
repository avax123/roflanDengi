<?php

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        'align_multiline_comment' => true,
        'array_indentation' => true,
        'array_syntax' => ['syntax' => 'short'],
        'backtick_to_shell_exec' => true,
        'combine_consecutive_unsets' => true,
        'compact_nullable_typehint' => true,
        'concat_space' => ['spacing' => 'one'],
        'escape_implicit_backslashes' => true,
        'explicit_indirect_variable' => true,
        'explicit_string_variable' => true,
        'fully_qualified_strict_types' => true,
        'function_declaration' => ['closure_function_spacing' => 'one'],
        'general_phpdoc_annotation_remove' => ['annotations' => ['author']],
        'heredoc_to_nowdoc' => true,
        'increment_style' => false,
        'linebreak_after_opening_tag' => true,
        'list_syntax' => ['syntax' => 'short'],
        'logical_operators' => true,
        'mb_str_functions' => true,
        'modernize_types_casting' => true,
        'multiline_comment_opening_closing' => true,
        'multiline_whitespace_before_semicolons' => true,
        'new_with_braces' => false,
        'no_alias_functions' => true,
        'no_binary_string' => true,
        'no_homoglyph_names' => true,
        'no_null_property_initialization' => true,
        'no_php4_constructor' => true,
        'no_superfluous_elseif' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'not_operator_with_successor_space' => true,
        'ordered_imports' => true,
        'phpdoc_add_missing_param_annotation' => ['only_untyped' => false],
        'phpdoc_no_alias_tag' => false,
        'phpdoc_no_empty_return' => false,
        'phpdoc_order' => true,
        'phpdoc_return_self_reference' => false,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_types_order' => ['null_adjustment' => 'always_last', 'sort_algorithm' => 'none'],
        'phpdoc_var_without_name' => false,
        'protected_to_private' => false,
        'return_assignment' => true,
        'semicolon_after_instruction' => false,
        'ternary_to_null_coalescing' => true,
        'void_return' => true,
    ])
    ->setFinder(PhpCsFixer\Finder::create()
        ->exclude('bin')
        ->exclude('public')
        ->exclude('templates')
        ->exclude('translations')
        ->exclude('var')
        ->exclude('node_modules')
        ->exclude('vendor')
        ->in(__DIR__)
    )
;

/*
This document has been generated with
https://mlocati.github.io/php-cs-fixer-configurator/
you can change this configuration by importing this YAML code:

fixerSets:
  - '@Symfony'
fixers:
  align_multiline_comment: true
  array_indentation: true
  array_syntax:
    syntax: short
  backtick_to_shell_exec: true
  combine_consecutive_unsets: true
  compact_nullable_typehint: true
  concat_space:
    spacing: one
  escape_implicit_backslashes: true
  explicit_indirect_variable: true
  explicit_string_variable: true
  fully_qualified_strict_types: true
  function_declaration:
    closure_function_spacing: one
  general_phpdoc_annotation_remove:
    annotations:
      - author
  heredoc_to_nowdoc: true
  increment_style: false
  linebreak_after_opening_tag: true
  list_syntax:
    syntax: short
  logical_operators: true
  mb_str_functions: true
  modernize_types_casting: true
  multiline_comment_opening_closing: true
  multiline_whitespace_before_semicolons: true
  new_with_braces: false
  no_alias_functions: true
  no_binary_string: true
  no_homoglyph_names: true
  no_null_property_initialization: true
  no_php4_constructor: true
  no_superfluous_elseif: true
  no_useless_else: true
  no_useless_return: true
  not_operator_with_successor_space: true
  ordered_imports: true
  phpdoc_add_missing_param_annotation:
    only_untyped: false
  phpdoc_no_alias_tag: false
  phpdoc_no_empty_return: false
  phpdoc_order: true
  phpdoc_return_self_reference: false
  phpdoc_trim_consecutive_blank_line_separation: true
  phpdoc_types_order:
    null_adjustment: always_last
    sort_algorithm: none
  protected_to_private: false
  return_assignment: true
  semicolon_after_instruction: false
  ternary_to_null_coalescing: true
  void_return: true
risky: true

*/