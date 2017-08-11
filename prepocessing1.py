import csv
import re
from nltk.tokenize import RegexpTokenizer
# from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
# create stemmer
# factory = StemmerFactory()
# stemmer = factory.create_stemmer()
with open('data/bikin_stopword1.txt') as f:
    content = f.readlines()
# you may also want to .txt'
content = [x.strip() for x in content]
 
f.close()

# create English stop words list
indo_stop = content
tokenizer = RegexpTokenizer(r'\w+')
i=0
hasil=[]
with open('data/data_januari-juni.csv') as raw:
    reader = csv.reader(raw)
    for row in reader:
        asli = ''.join(row).lower()
        cinta = tokenizer.tokenize(asli)
        bersih = [i for i in cinta if not i in indo_stop]
        for kata in bersih:
            hasil.append(kata)
        i=i+1
        # print(bersih)    
#         print(tokenizer.tokenize(hasil))
#         stopped_tokens = [i for i in asli if not i in indo_stop]
#         print(stopped_tokens)
#         forename = hasil
raw.close()

with open('data/200.daftar_kata.csv', 'w', newline='') as tulisFile:
    tulisFileWriter = csv.writer(tulisFile)
    for row in hasil:

        tulisFileWriter.writerow([row])
       
tulisFile.close()