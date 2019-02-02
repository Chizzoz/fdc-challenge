# CODE CHALLENGE

In this exercise, you're going to decompress a compressed string.

Your input is a compressed string of the format number[string] and the decompressed output form should be the string written number times. For example:

The input

`3[abc]4[ab]c`

Would be output as

`abcabcabcababababc`

Other rules:

* Number can have more than one digit. For example, `10[a]` is allowed, and just means `aaaaaaaaaa`

* One repetition can occur inside another. For example, `2[3[a]b]` decompresses into `aaabaaab`

* Characters allowed as input include digits, small English letters and brackets [ ].

* Digits are only to represent amount of repetitions.

* Letters are just letters.

* Brackets are only part of syntax of writing repeated substring.

* Input is always valid, so no need to check its validity.

# The CODE

```
<?php
	function decompress($compressed_string)
	{
		while (strpos($compressed_string, "[") !== false)
		{
			// Last '[' occurrence
			$start = strrpos($compressed_string, '[');
			// First ']' occurrence after last '[' occurrence
			$end = strpos($compressed_string, ']', $start);
			// find multiplier
			// Negative start position for last '[' occurrence
			$negative_start = ($start - strlen($compressed_string)) - 1;
			$preceding_open_bracket = strrpos($compressed_string, "[", $negative_start);
			$preceding_close_bracket = strrpos($compressed_string, "]", $negative_start);
			if ($preceding_close_bracket > $preceding_open_bracket)
			{
				$preceding_bracket = $preceding_close_bracket;
			} elseif ($preceding_open_bracket > $preceding_close_bracket)
			{
				$preceding_bracket = $preceding_open_bracket;
			} else
			{
				$preceding_bracket = 0;
			}
			// multiplier for last [] group
			if ($preceding_bracket == 0)
			{
				$multiplier = substr($compressed_string, $preceding_bracket, ($start - $preceding_bracket));
			} else
			{
				$multiplier = substr($compressed_string, $preceding_bracket + 1, ($start - $preceding_bracket) - 1);
			}
			// String section to be multiplied
			$section = substr($compressed_string, ($start + 1), ($end - $start) - 1);
			// expand compressed string section
			$result = str_repeat($section, (int)$multiplier);
			// replace compressed string section with expanded string section
			if ($preceding_bracket == 0)
			{
				$compressed_string = substr_replace($compressed_string, $result, $preceding_bracket, strlen($multiplier . "[" . $section . "]"));
			} else
			{
				$compressed_string = substr_replace($compressed_string, $result, $preceding_bracket + 1, strlen($multiplier . "[" . $section . "]"));
			}
		}
		
		return $compressed_string;
	}
?>
```
