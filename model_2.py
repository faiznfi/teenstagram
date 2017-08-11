from gensim import corpora
import logging
import gensim

# create stemmer

dictionar = dictionary.load('dictionary/dictionary_stem.dict')
corpus = [dictionary.doc2bow(text) for text in hasil]
corpora.MmCorpus.serialize('dictionary/corpora_stem.mm', corpus)

logging.basicConfig(filename='rekap_model/rekapmodel_2_15_stem.csv', filemode='w',format='%(asctime)s : %(levelname)s : %(message)s', level=logging.INFO)
#logging.basicConfig(format='%(asctime)s : %(levelname)s : %(message)s', level=logging.INFO)
from gensim import corpora, models, similarities
from gensim.models import ldamodel
for i in range(1):
    lda_a = ldamodel.LdaModel(corpus, id2word=dictionary, num_topics=2, passes=15, alpha='auto')
    lda_a.save('model/stem/model_2_15_stem.model')
    # lda_a.print_topics(-1)p

