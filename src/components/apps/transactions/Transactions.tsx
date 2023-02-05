import { useState } from 'react';
import { PlusOutlined } from '@ant-design/icons';
import { Button } from 'antd';
import { useTranslation } from 'react-i18next';
import { TransactionTable } from '../../tables/Transactions/TransactionTable';
import * as S from './Transactions.styles';
import TransactionModal from '@app/components/modals/modal/TransactionModal';

export const Transactions: React.FC = () => {
  const { t } = useTranslation();

  const [open, setOpen] = useState(false);

  return (
    <S.TransactionWrapper>
      <TransactionModal open={open} setOpen={setOpen} />
      <S.Card
        id="transaction-table"
        title={t('tables.title', { name: 'Transactions' })}
        padding="1.25rem 1.25rem 0"
        extra={
          <S.ActionWrapper>
            <Button
              type="ghost"
              icon={<PlusOutlined />}
              onClick={() => setOpen((open) => !open)}
            >
              {t('actions.new', { name: 'Transaction' })}
            </Button>
          </S.ActionWrapper>
        }
      >
        <TransactionTable />
      </S.Card>
    </S.TransactionWrapper>
  );
};
