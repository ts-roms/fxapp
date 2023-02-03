import { PlusOutlined } from '@ant-design/icons';
import { Button } from 'antd';
import { useTranslation } from 'react-i18next';
import { TransactionTable } from '../../tables/Transactions/TransactionTable';
import * as S from './Transactions.styles';

export const Transactions: React.FC = () => {
  const { t } = useTranslation();

  return (
    <S.TransactionWrapper>
      <S.Card
        id="transaction-table"
        title={t('tables.title', { name: 'Transactions' })}
        padding="1.25rem 1.25rem 0"
        extra={
          <>
            <Button type="ghost" icon={<PlusOutlined />} onClick={() => console.log('Add new transaction')}>
              {t('actions.new', { name: 'Transaction' })}
            </Button>
          </>
        }
      >
        <TransactionTable />
      </S.Card>
    </S.TransactionWrapper>
  );
};
