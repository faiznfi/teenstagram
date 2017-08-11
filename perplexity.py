# import csv
# from nltk.tokenize import RegexpTokenizer
# from Sastrawi.Stemmer.StemmerFactory import StemmerFactory

# # create English stop words list
# tokenizer = RegexpTokenizer(r'([0-9])+\.([0-9]) (perplexity)')

# with open('rekapmodel_3_30.csv') as raw:
#     reader = csv.reader(raw)
#     for row in reader:
#         asli = ''.join(row)
#         cinta = tokenizer.tokenize(asli)
# 		print(cinta)
    
# #         print(tokenizer.tokenize(hasil))
# #         stopped_tokens = [i for i in asli if not i in indo_stop]
# #         print(stopped_tokens)
# #         forename = hasil
# raw.close()

import re
lines = [line.strip() for line in open('rekapmodel_3_30.csv')]
for x in lines:
    match=re.search(r'([0-9])+\.([0-9]) (perplexity)',x)
    if match: print (x)

