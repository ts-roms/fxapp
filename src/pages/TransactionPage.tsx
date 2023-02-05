import { PageTitle } from '@app/components/common/PageTitle/PageTitle';
import { Transactions } from '@app/components/apps/transactions/Transactions';
import { useTranslation } from 'react-i18next';

const TransactionPage: React.FC = () => {
  const { t } = useTranslation();

  return (
    <>
      <PageTitle>{t('common.transactions')}</PageTitle>
      <Transactions />
    </>
  );
};

export default TransactionPage;
