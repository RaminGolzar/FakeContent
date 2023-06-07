# FakeContent

This library is written in **pure PHP**

This library is suitable for generating **fake content** to store in the **database**.

In this project not used from **RegEx** & it has its own grammar.

## Grammar guide

1. Use **#** to generate number sequentially
2. Use **[#]** to generate a random number
3. Use **$** to generate character sequentially (is upper case)
4. Use **[$]** to generate random character (is upper case)
5. Use **@** to generate character sequentially (is lower case)
6. Use **[@]** to generate random character (is lower case)
7. Use **[%]** to generate random symbols
8. Use **date()** method to generate current date
9. Use **time()** method to generate current time
10. Use **date_time()** method to generate current date & time
11. Use **hash(content , method[^1])** method to encrypt specific content
12. Use **lorem_char(min , max)**[^2] function to generate string based on the number of character
13. Use **lorem_word(min , max)**[^3] method to generate string based on the number of word
14. Use **[a-z]** to generate random character in the specific range (is lover case)
15. Use **[A-Z]** to generate random character in the specific range (is upper case)
16. Use **[10-100]** to generate random number in the specific range

[^1]: Allowed: md5 , sha1 , password_hash.
[^2]: To fixed length, just set the first parameter.
[^3]: To fixed length, just set the first parameter.
