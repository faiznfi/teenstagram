import csv
from gensim import corpora
import logging
import gensim

from sklearn.decomposition import LatentDirichletAllocation as LDA
from nltk.tokenize import RegexpTokenizer
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
# create stemmer
hasil=[]
i=0
tokenizer = RegexpTokenizer(r'\w+')
with open('data/2.data_training_with_stem.csv') as raw:
    reader = csv.reader(raw)
    for row in reader:
        asli = ''.join(row)
        cinta = tokenizer.tokenize(asli)
        hasil.append(cinta)
        i=i+1

#         print(tokenizer.tokenize(hasil))
#         stopped_tokens = [i for i in asli if not i in indo_stop]
#         print(stopped_tokens) \
#         forename = hasil

raw.close()
dictionary = corpora.Dictionary(hasil)
dictionary.save('dictionary/dictionary_stem.dict')
corpus = [dictionary.doc2bow(text) for text in hasil]
corpora.MmCorpus.serialize('dictionary/corpora_stem.mm', corpus)

logging.basicConfig(filename='rekap_model/rekapmodel_6_30_stem.csv', filemode='w',format='%(asctime)s : %(levelname)s : %(message)s', level=logging.INFO)
#logging.basicConfig(format='%(asctime)s : %(levelname)s : %(message)s', level=logging.INFO)
from gensim import corpora, models, similarities
from gensim.models import ldamodel
for i in range(30):
    lda_a = ldamodel.LdaModel(corpus, id2word=dictionary, num_topics=6, passes=30, alpha='auto')
    lda_a.save('model/stem/model_6_30_stem.model')
    # lda_a.print_topics(-1)p