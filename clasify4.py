from gensim.models import LdaModel
import csv
from gensim import corpora
import logging
import gensim
import sys
from sklearn.decomposition import LatentDirichletAllocation as LDA
from nltk.tokenize import RegexpTokenizer
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory

# create stemmer
text = sys.argv[1]
hasil = []
i = 0
tokenizer = RegexpTokenizer(r'\w+')
with open('data/2.data_training_with_stem.csv') as raw:
    reader = csv.reader(raw)
    for row in reader:
        asli = ''.join(row)
        cinta = tokenizer.tokenize(asli)
        hasil.append(cinta)
        i = i + 1

# print(tokenizer.tokenize(hasil))
#         stopped_tokens = [i for i in asli if not i in indo_stop]
#         print(stopped_tokens)
#         forename = hasil
raw.close()

dictionary = corpora.Dictionary(hasil)
dictionary.load('dictionary/dictionary.dict')
# print(dictionary.token2id)

loading = LdaModel.load('model/stem/model_4_30_stem.model')
# print(loading.print_topics(num_topics=3, num_words=3))
def pre_new(doc):
    one = doc.split(' ')
    two = dictionary.doc2bow(one)
    return two

# with open('data/data_januari-juni.csv') as raw:
# 	reader = csv.reader(raw)
# 	for row in reader:
# 		file = ''.join(row)
# 		pre_new(file)
# 		belong = loading[(pre_new(file))]
# 		print(max(belong, key=lambda item: item[1])[0])


belong = loading[(pre_new(text))]
print(max(belong, key=lambda item: item[1])[0])

# with open('5.label.data.csv', 'w' ) as match:
#     tulisFileWriter = csv.writer(match)
#     for row in belong:
#         tulisFileWriter.writerow(row)

# match.close()


# new = (belong,columns=['id','prob']).sort_values('prob',ascending=False)
# new['a.model'] = new['id'].apply(loading.print_topic)
# new